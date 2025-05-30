<?php

namespace App;

class MySQLQueryBuilder implements QueryBuilderInterface
{
    protected $select = [];
    protected $from = '';
    protected $where = [];

    public function select($columns): QueryBuilderInterface
    {
        if (is_string($columns)) {
            $columns = explode(',', $columns);
            $columns = array_map('trim', $columns);
        }

        $this->select = array_merge($this->select, $columns);

        return $this;
    }

    public function from(string $table): QueryBuilderInterface
    {
        $this->from = $table;

        return $this;
    }

    public function where(string $condition): QueryBuilderInterface
    {
        $this->where = [$condition];

        return $this;
    }

    public function andWhere(string $condition): QueryBuilderInterface
    {
        $this->where[] = ['AND', $condition];

        return $this;
    }

    public function orWhere(string $condition): QueryBuilderInterface
    {
        $this->where[] = ['OR', $condition];

        return $this;
    }


    public function build(): string
    {
        if (empty($this->select)) {
            $this->select = ['*'];
        }

        if (empty($this->from)) {
            throw new \RuntimeException('La clause FROM est obligatoire.');
        }

        $sql = 'SELECT ' . implode(', ', $this->select) . ' FROM ' . $this->from;

        if (!empty($this->where)) {
            $sql .= ' WHERE ';
            $cond = array_shift($this->where);
            $sql .= is_array($cond) ? $cond[1] : $cond;

            foreach ($this->where as $condition) {
                $sql .= ' ' . $condition[0] . ' ' . $condition[1];
            }
        }

        return $sql;
    }
}