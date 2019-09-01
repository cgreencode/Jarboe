<?php

namespace Yaro\Jarboe\Tests\Fields;

use Yaro\Jarboe\Table\Fields\AbstractField;
use Yaro\Jarboe\Table\Fields\Textarea;
use Yaro\Jarboe\Tests\Fields\Traits\ClipboardTests;
use Yaro\Jarboe\Tests\Fields\Traits\InlineTests;
use Yaro\Jarboe\Tests\Fields\Traits\NullableTests;
use Yaro\Jarboe\Tests\Fields\Traits\OrderableTests;
use Yaro\Jarboe\Tests\Fields\Traits\PlaceholderTests;
use Yaro\Jarboe\Tests\Fields\Traits\TooltipTests;
use Yaro\Jarboe\Tests\Fields\Traits\TranslatableTests;

class TextareaFieldTest extends AbstractFieldTest
{
    use OrderableTests;
    use NullableTests;
    use TooltipTests;
    use ClipboardTests;
    use InlineTests;
    use TranslatableTests;
    use PlaceholderTests;

    protected function getFieldWithName(): AbstractField
    {
        return Textarea::make(self::NAME);
    }

    protected function getFieldWithNameAndTitle(): AbstractField
    {
        return Textarea::make(self::NAME, self::TITLE);
    }
}
