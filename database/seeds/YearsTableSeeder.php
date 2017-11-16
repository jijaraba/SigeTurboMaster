<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Year;

class YearsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('years')->delete();
        Year::create(
            [
                'idyear' => '1995',
                'idcalendar' => 2,
                'name' => '1995-1996',
                'prefix' => '1995',
                'starts' => '1995-08-08',
                'ends' => '1996-06-08'
            ]
        );
        Year::create(
            [
                'idyear' => '1996',
                'idcalendar' => 2,
                'name' => '1996-1997',
                'prefix' => '1996',
                'starts' => '1996-08-08',
                'ends' => '1997-06-08'
            ]
        );
        Year::create(
            [
                'idyear' => '1997',
                'idcalendar' => 2,
                'name' => '1997-1998',
                'prefix' => '1997',
                'starts' => '1997-08-08',
                'ends' => '1998-06-08'
            ]
        );
        Year::create(
            [
                'idyear' => '1998',
                'idcalendar' => 2,
                'name' => '1998-1999',
                'prefix' => '1998',
                'starts' => '1998-08-08',
                'ends' => '1999-06-08'
            ]
        );
        Year::create(
            [
                'idyear' => '1999',
                'idcalendar' => 2,
                'name' => '1999-2000',
                'prefix' => '1999',
                'starts' => '1999-08-08',
                'ends' => '2000-06-08'
            ]
        );
        Year::create(
            [
                'idyear' => '2000',
                'idcalendar' => 2,
                'name' => '2000-2001',
                'prefix' => '2000',
                'starts' => '2000-08-08',
                'ends' => '2001-06-08'
            ]
        );
        Year::create(
            [
                'idyear' => '2001',
                'idcalendar' => 2,
                'name' => '2001-2002',
                'prefix' => '2001',
                'starts' => '2001-08-08',
                'ends' => '2002-06-08'
            ]
        );
        Year::create(
            [
                'idyear' => '2002',
                'idcalendar' => 2,
                'name' => '2002-2003',
                'prefix' => '2002',
                'starts' => '2002-08-08',
                'ends' => '2003-06-08'
            ]
        );
        Year::create(
            [
                'idyear' => '2003',
                'idcalendar' => 2,
                'name' => '2003-2004',
                'prefix' => '2003',
                'starts' => '2003-08-08',
                'ends' => '2004-06-08'
            ]
        );
        Year::create(
            [
                'idyear' => '2004',
                'idcalendar' => 2,
                'name' => '2004-2005',
                'prefix' => '2004',
                'starts' => '2004-08-08',
                'ends' => '2005-06-08'
            ]
        );
        Year::create(
            [
                'idyear' => '2005',
                'idcalendar' => 2,
                'name' => '2005-2006',
                'prefix' => '2005',
                'starts' => '2005-08-08',
                'ends' => '2006-06-08'
            ]
        );
        Year::create(
            [
                'idyear' => '2006',
                'idcalendar' => 2,
                'name' => '2006-2007',
                'prefix' => '2006',
                'starts' => '2006-07-31',
                'ends' => '2007-08-07'
            ]
        );
        Year::create(
            [
                'idyear' => '2007',
                'idcalendar' => 2,
                'name' => '2007-2008',
                'prefix' => '2007',
                'starts' => '2007-08-08',
                'ends' => '2008-04-01'
            ]
        );
        Year::create(
            [
                'idyear' => '2008',
                'idcalendar' => 2,
                'name' => '2008-2009',
                'prefix' => '2008',
                'starts' => '2008-08-05',
                'ends' => '2009-05-10'
            ]
        );
        Year::create(
            [
                'idyear' => '2009',
                'idcalendar' => 2,
                'name' => '2009-2010',
                'prefix' => '2009',
                'starts' => '2009-07-27',
                'ends' => '2010-08-02'
            ]
        );
        Year::create(
            [
                'idyear' => '2010',
                'idcalendar' => 2,
                'name' => '2010-2011',
                'prefix' => '2010',
                'starts' => '2010-08-02',
                'ends' => '2011-07-31'
            ]
        );
        Year::create(
            [
                'idyear' => '2011',
                'idcalendar' => 2,
                'name' => '2011-2012',
                'prefix' => '2011',
                'starts' => '2011-08-01',
                'ends' => '2012-06-30'
            ]
        );
        Year::create(
            [
                'idyear' => '2012',
                'idcalendar' => 2,
                'name' => '2012-2013',
                'prefix' => '2012',
                'starts' => '2012-08-01',
                'ends' => '2013-07-31'
            ]
        );
        Year::create(
            [
                'idyear' => '2013',
                'idcalendar' => 2,
                'name' => '2013-2014',
                'prefix' => '2013',
                'starts' => '2013-08-01',
                'ends' => '2014-07-31'
            ]
        );
        Year::create(
            [
                'idyear' => '2014',
                'idcalendar' => 2,
                'name' => '2014-2015',
                'prefix' => '2014',
                'starts' => '2014-08-01',
                'ends' => '2015-07-31'
            ]
        );
        Year::create(
            [
                'idyear' => '2015',
                'idcalendar' => 2,
                'name' => '2015-2016',
                'prefix' => '2015',
                'starts' => '2015-08-01',
                'ends' => '2016-07-31'
            ]
        );
        Year::create(
            [
                'idyear' => '2016',
                'idcalendar' => 2,
                'name' => '2016-2017',
                'prefix' => '2016',
                'starts' => '2016-08-01',
                'ends' => '2017-07-31'
            ]
        );

    }

}
