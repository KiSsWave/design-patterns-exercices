<?php

namespace App;

interface QueryBuilderInterface
{


    public function select($columns): QueryBuilderInterface;
    public function from(string $table): QueryBuilderInterface;
    public function where(string $condition): QueryBuilderInterface;

    public function andWhere(string $condition): QueryBuilderInterface;

    public function orWhere(string $condition): QueryBuilderInterface;
    public function build(): string;
}