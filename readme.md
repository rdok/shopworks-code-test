### Preparations
- Set up development machine & test data: `vagrant up`
- Append to your hosts file: `192.168.10.10 shopworks-code.test`

### View
- Visit http://shopworks-code.test/


### Notes
- The starttime and endtime do not end in the same day. As such we cannot use
timediff, or time_to_sec query options. So, the only thing we could do, in my
opinion, is to rely on PHP instead. See
`tests\Unit\app\Acme\RotalSlotStaff\BonusWorkHoursTest.php`