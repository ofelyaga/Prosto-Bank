<?php

interface Database
{
public function get(array $where): ?array;
public function insert(array $data): void;
public function update(array $updateData, array $where): void;
public function delete(array $where): void;
}