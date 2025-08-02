<?php

namespace App\Models;

use Laravel\Jetstream\Clientship as JetstreamClientship;

class Clientship extends JetstreamClientship
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
