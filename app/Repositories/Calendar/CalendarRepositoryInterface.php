<?php

namespace SigeTurbo\Repositories\Calendar;

interface CalendarRepositoryInterface
{
    public function all();
    public function find($calendar);
}