<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LessonControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider dataShow
     */
    public function testShow($expectedMark, $capacity, $reservationCount) {
        $lesson = Lesson::factory()->create([
            'name' => '楽しいヨガレッスン',
            'capacity' => $capacity,
        ]);
        for ($i = 0; $i < $reservationCount; $i++) {
            $user = User::factory()->create();
            Reservation::factory()->create([
                'lesson_id' => $lesson->id,
                'user_id' => $user->id,
            ]);
        }
        $response = $this->get("/lessons/{$lesson->id}");
        $response->assertStatus(Response::HTTP_OK)
            ->assertSee($lesson->name)
            ->assertSee('空き状況: ' . $expectedMark);
    }

    public function dataShow() {
        return [
            "キャパ10、予約数5" => [
                'expectedMark' => "◎",
                'capacity' => 10,
                'reservationCount' => 5,
            ],
            "キャパ10、予約数6" => [
                'expectedMark' => "△",
                'capacity' => 10,
                'reservationCount' => 6,
            ],
            "キャパ10、予約数10" => [
                'expectedMark' => "×",
                'capacity' => 10,
                'reservationCount' => 10,
            ],
        ];
    }
}
