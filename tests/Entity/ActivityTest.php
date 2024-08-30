<?php

namespace App\Tests\Entity;

use App\Entity\Activity;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ActivityTest extends KernelTestCase
{
    public function testIsExpiredIsTrueIfMeetingDateIsInPast(): void
    {
        $activity = (new Activity())->setMeetingDate(new \DateTime("-2 days"));
        $this->assertTrue($activity->isExpired());
    }

    public function testIsExpiredIsFalseIfMeetingDateIsToday(): void
    {
        $activity = (new Activity())->setMeetingDate(new \DateTime());
        $this->assertFalse($activity->isExpired());
    }

    public function testIsExpiredIsFalseIfMeetingDateIsInFuture(): void
    {
        $activity = (new Activity())->setMeetingDate(new \DateTime("+2 days"));
        $this->assertFalse($activity->isExpired());
    }
}