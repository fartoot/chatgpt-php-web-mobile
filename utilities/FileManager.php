<?php 

        abstract class FileManager {
            public string $dir;
            public string $extension;

            public function __construct($dir) {
                $this->dir = $dir;
            }

            abstract public function read();
            abstract public function write();
            abstract public function new();

        }