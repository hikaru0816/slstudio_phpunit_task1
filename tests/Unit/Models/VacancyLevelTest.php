<?php

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use App\Models\VacancyLevel;

class VacancyLevelTest extends TestCase
{

    /**
     * @dataProvider judgeProvider
     */
    public function testJudge(int $remainingCount, array $expectedParam) {
        $level = new VacancyLevel($remainingCount);
        $actual = $level->judge();
        $this->assertSame($expectedParam, $actual);
    }

    public function judgeProvider() {
        return [
            '空き無し' => [
                'remainingCount' => 0,
                'expectedParam' => [
                    'mark' => '×',
                    'slug' => 'empty'
                ]
            ],
            '残り僅か' => [
                'remainingCount' => 4,
                'expectedParam' => [
                    'mark' => '△',
                    'slug' => 'few'
                ]
            ],
            '空き十分' => [
                'remainingCount' => 5,
                'expectedParam' => [
                    'mark' => '◎',
                    'slug' => 'enough'
                ]
            ],
        ];
    }


    // /**
    //  * @dataProvider slugProvider
    //  */
    // public function testSlug(int $remainingCount, string $expectedSlug) {
    //     $level = new VacancyLevel($remainingCount);
    //     $actual = $level->slug();
    //     $this->assertSame($expectedSlug, $actual);
    // }

    // public function slugProvider() {
    //     return [
    //         '空き無し' => [
    //             'remainingCount' => 0,
    //             'expectedSlug' => 'empty'
    //         ],
    //         '残り僅か' => [
    //             'remainingCount' => 4,
    //             'expectedSlug' => 'few'
    //         ],
    //         '空き十分' => [
    //             'remainingCount' => 5,
    //             'expectedSlug' => 'enough'
    //         ],
    //     ];
    // }
}
