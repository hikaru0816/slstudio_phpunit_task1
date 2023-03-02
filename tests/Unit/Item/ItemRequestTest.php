<?php

namespace Tests\Unit\Brand;

use App\Admin\Requests\ItemRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

/**
 * 商品リクエストテスト
 *
 * コマンド実行する場合はプロジェクトのルートディレクトリ上で実行すること
 * $ ./vendor/bin/phpunit ./tests/Unit/Item/ItemRequestTest.php
 */
class ItemRequestTest extends TestCase
{

    /**
     * 概要 商品名・商品説明のパラメーター化テスト
     * 条件 データプロバイダメソッドのラベル
     * 結果 条件に応じた結果(true, false)を返すこと
     *
     * @dataProvider validationDataProvider
     */
    public function test_パラメーター化テスト($param, $expected)
    {
        $request = new ItemRequest();
        $rules = $request->rules();
        $validator = Validator::make($param, $rules);
        $actual = $validator->passes();
        $this->assertSame($expected, $actual);
    }
    // データプロバイダメソッド
    public function validationDataProvider(): array
    {
        // 'ラベル' => [パラメータ, 期待値]
        return [
            '商品名が1文字かつ商品説明が1文字の場合' => [
                [
                    'name' => 'a',
                    'description' => 'a',
                ],
                /* 期待値 */
                true
            ],
            '商品名が10文字かつ商品説明が50文字の場合' => [
                [
                    'name' => 'aaaaaaaaaa',
                    'description' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                ],
                /* 期待値 */
                true
            ],
            '商品名が10文字かつ商品説明が1文字の場合' => [
                [
                    'name' => 'aaaaaaaaaa',
                    'description' => 'a',
                ],
                /* 期待値 */
                true
            ],
            '商品名が1文字かつ商品説明が50文字の場合' => [
                [
                    'name' => 'a',
                    'description' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                ],
                /* 期待値 */
                true
            ],
            '商品名が0文字かつ商品説明が0文字の場合' => [
                [
                    'name' => '',
                    'description' => '',
                ],
                /* 期待値 */
                false
            ],
            '商品名が11文字かつ商品説明が51文字の場合' => [
                [
                    'name' => 'aaaaaaaaaaa',
                    'description' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                ],
                /* 期待値 */
                false
            ],
            '商品名が10文字かつ商品説明が0文字の場合' => [
                [
                    'name' => 'aaaaaaaaaa',
                    'description' => '',
                ],
                /* 期待値 */
                false
            ],
            '商品名が0文字かつ商品説明が50文字の場合' => [
                [
                    'name' => '',
                    'description' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                ],
                /* 期待値 */
                false
            ],
            '商品名が10文字かつ商品説明が51文字の場合' => [
                [
                    'name' => 'aaaaaaaaaa',
                    'description' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                ],
                /* 期待値 */
                false
            ],
            '商品名が11文字かつ商品説明が50文字の場合' => [
                [
                    'name' => 'aaaaaaaaaaa',
                    'description' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                ],
                /* 期待値 */
                false
            ],
        ];
    }
}
