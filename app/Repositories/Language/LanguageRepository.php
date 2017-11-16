<?php

namespace SigeTurbo\Repositories\Language;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Language;

class LanguageRepository implements LanguageRepositoryInterface
{

    /**
     * Get All Language
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Cache::remember('languages', 1440, function() {
            return Language::all();
        });
    }

    /**
     * Find Language
     * @param $language
     * @return mixed
     */
    public function find($language)
    {
        return Language::find($language);
    }
}