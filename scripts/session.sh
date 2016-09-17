#!/bin/bash
# Usage: ./session.sh [time in seconds] [ip address] [LOGIN|LOGOUT]
sudo -u proxy /usr/lib/squid3/ext_session_acl -a -T $1 -b /var/lib/squid/session <<< "10 $2 $3"
