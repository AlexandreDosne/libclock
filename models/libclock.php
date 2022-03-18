<?php
 /******************************************************\
 *                  Mouflon Solutions™                  *
 *______________________________________________________*
 *                   Alexandre Dosne                    *
 *       https://github.com/AlexandreDosne/libclock     *
 \******************************************************/

class ClockTime
{
    public int $seconds;
    public int $minutes;
    public int $hours;

    public function __construct(int $seconds = 0, int $minutes = 0, int $hours = 0)
    {
        $this->seconds = $seconds;
        $this->minutes = $minutes;
        $this->hours = $hours;
    }

    public function GetSeconds(): string
    {
        return self::_addLeadingZero($this->seconds);
    }

    public function GetMinutes(): string
    {
        return self::_addLeadingZero($this->minutes);
    }

    public function GetHours(): string
    {
        return self::_addLeadingZero($this->hours);
    }

    private static function _addLeadingZero(int &$member): string
    {
        $ret = '';

        if ($member < 10)
            $ret .= '0';

        $ret .= $member;

        return $ret;
    }
}

class Clock extends ClockTime
{
    public function __construct(int $seconds = 0, int $minutes = 0, int $hours = 0)
    {
        parent::__construct($seconds, $minutes, $hours);
    }

    public function AddTime(int $seconds, int $minutes = 0, int $hours = 0): ClockTime
    {
        $this->seconds += $seconds;
        $this->minutes += $minutes;
        $this->hours += $hours;
        self::_performInternalChecks($this);
        return new ClockTime($this->seconds, $this->minutes, $this->hours);
    }

    private static function _performInternalChecks(Clock &$c)
    {
        $INVERSE_60 = 0.0166666666666666;

        // sec
        if ($c->seconds >= 60)
        {
            $carry = intval($c->seconds * $INVERSE_60);
            for ($i = 0; $i < $carry; $i++)
            {
                $c->seconds -= 60;
                $c->minutes++;
            }
        }

        // min
        if ($c->minutes >= 60)
        {
            $carry = intval($c->minutes * $INVERSE_60);
            for ($i = 0; $i < $carry; $i++)
            {
                $c->minutes -= 60;
                $c->hours++;
            }
        }
    }
}
