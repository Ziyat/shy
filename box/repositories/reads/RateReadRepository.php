<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\repositories\reads;


use box\entities\rate\Rate;

class RateReadRepository
{
    public function find($id): ?Rate
    {
        return Rate::findOne($id);
    }

}