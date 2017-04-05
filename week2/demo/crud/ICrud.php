<?php

interface ICrud {
    public function create();
    public function read();
    public function readAll();
    public function update();
    public function delete();
}