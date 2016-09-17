#!/bin/bash
sudo -u proxy /usr/lib/squid3/ext_session_acl -a -T $1 -b /var/lib/squid/session <<< "10 $2 $3"
