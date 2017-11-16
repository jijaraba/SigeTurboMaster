<?php

namespace SigeTurbo\Repositories\Language;

interface LanguageRepositoryInterface {
    public function all();
    public function find($language);
}