<?php

namespace App\Interface;

interface commentInterface
{
    public function index();
    public function show($id);
    public function store($request,$id);
    public function update($request, $id);
    public function destroy($id);
}
