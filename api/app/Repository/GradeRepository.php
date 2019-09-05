<?php
declare(strict_types=1);

namespace App\Repository;

class GradeRepository extends BaseRepository
{
    function model()
    {
        return 'App\Model\Grade';
    }
}