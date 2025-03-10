<?php

namespace App;

class LitteralBuilder implements QueryBuilderInterface
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
        if (empty($this->where)) {
            return $this->where($condition);
        }

        $this->where[] = ['ET', $condition];

        return $this;
    }

    public function orWhere(string $condition): QueryBuilderInterface
    {
        if (empty($this->where)) {
            return $this->where($condition);
        }

        $this->where[] = ['OU', $condition];

        return $this;
    }


    public function build(): string
    {
        if (empty($this->select)) {
            $this->select = ['toutes les colonnes'];
        }

        if (empty($this->from)) {
            throw new \RuntimeException('La table source doit être spécifiée.');
        }

        $text = 'Je sélectionne ' . implode(', ', $this->select) . ' de la table ' . $this->from;

        if (!empty($this->where)) {
            $text .= ' où ';
            $cond = array_shift($this->where);
            $text .= is_array($cond) ? $cond[1] : $cond;

            foreach ($this->where as $condition) {
                $text .= ' ' . $condition[0] . ' ' . $condition[1];
            }
        }

        return $text . '.';
    }
}