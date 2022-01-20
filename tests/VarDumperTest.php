<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\VarDumper\Cloner\Stub;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Test\VarDumperTestTrait;

class VarDumperTest extends TestCase
{
    use VarDumperTestTrait;

    /** @test */
    public function it_with_default_dump_equals(): void
    {
        $testedVar = [123, 'foo'];
        // 预期的转储内容没有默认 VarDumper 结构，因为测试中使用了自定义结构和标志
        $expectedDump = <<<EOTXT
array:2 [
  0 => 123
  1 => "foo"
]
EOTXT;
        // 如果第一个参数是一个字符串，它必须是整个预期的转储
        $this->assertDumpEquals($expectedDump, $testedVar);

        // 如果第一个参数不是字符串，`assertDumpEquals()` 会转储它并将其与第二个参数的转储进行比较
        $this->assertDumpEquals($testedVar, $testedVar);
    }

    /** @test */
    public function allows_non_scalar_expectation(): void
    {
        $this->assertDumpEquals(
            new \ArrayObject(['foo' => 'bar']),
            new \ArrayObject(['foo' => 'bar']),
        );
    }

    /**
     * @test
     * @group formatted
     *
     * @dataProvider providerFormatResult
     */
    public function it_can_be_configured(int $flags, string $expectedDump): void
    {
        $casters = [
            DateTimeInterface::class => static function (DateTimeInterface $date, array $a, Stub $stub): array {
                $stub->class = 'DateTime';

                return ['date' => $date->format('Y-m-d H:i:s')];
            },
        ];
        $this->setUpVarDumper($casters, $flags);

        $testedVar = [123, 'foo', new \DateTime('2021-01-20T0:00:00+00:00')];

        $this->assertSame($flags, $this->varDumperConfig['flags']);
        $this->assertSame($casters, $this->varDumperConfig['casters']);

        $this->assertDumpEquals($expectedDump, $testedVar);
    }

    public function providerFormatResult(): array
    {
        return [
            'using DUMP_LIGHT_ARRAY flag' => [
                CliDumper::DUMP_LIGHT_ARRAY,
                <<<EXTXT
[
  123
  "foo"
  DateTime {
    +date: "2021-01-20 00:00:00"
  }
]
EXTXT,
            ],
            'using DUMP_STRING_LENGTH flag' => [
                CliDumper::DUMP_STRING_LENGTH,
                <<<EXTXT
array:3 [
  0 => 123
  1 => (3) "foo"
  2 => DateTime {
    +date: (19) "2021-01-20 00:00:00"
  }
]
EXTXT,

            ],
            'using DUMP_COMMA_SEPARATOR flag' => [
                CliDumper::DUMP_COMMA_SEPARATOR,
                <<<EXTXT
array:3 [
  0 => 123,
  1 => "foo",
  2 => DateTime {
    +date: "2021-01-20 00:00:00"
  }
]
EXTXT,

            ],
            'using DUMP_TRAILING_COMMA flag' => [
                CliDumper::DUMP_TRAILING_COMMA,
                <<<EXTXT
array:3 [
  0 => 123,
  1 => "foo",
  2 => DateTime {
    +date: "2021-01-20 00:00:00"
  },
]
EXTXT,

            ],

            'using DUMP_LIGHT_ARRAY and DUMP_STRING_LENGTH flags' => [
                CliDumper::DUMP_LIGHT_ARRAY | CliDumper::DUMP_STRING_LENGTH,
                <<<EXTXT
[
  123
  (3) "foo"
  DateTime {
    +date: (19) "2021-01-20 00:00:00"
  }
]
EXTXT,

            ],
        ];
    }
}
