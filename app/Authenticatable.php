<?php

namespace App;

interface Authenticatable {
    public function isMod();
    public function isAdmin();
}
