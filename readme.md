### Preparations
- Set up development machine & test data: `vagrant up`
- Append to your hosts file: `192.168.10.10 shopworks-code.test`

### View
- Visit http://shopworks-code.test/


### Notes
- The starttime and endtime do not end in the same end. As such we cannot use
timediff, to time_to_sec query options. So, the only thing I knew we could do,
is to rely on PHP instead.
