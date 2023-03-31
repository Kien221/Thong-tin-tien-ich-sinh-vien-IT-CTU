<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MotelStatus extends Enum
{
    const Con_Phong = 1;
    const Het_Phong = 0;
    public function getArrayView(){
        return [
            self::Con_Phong => 'Còn Phòng',
            self::Het_Phong => 'Hết Phòng',
        ];
    }
}
