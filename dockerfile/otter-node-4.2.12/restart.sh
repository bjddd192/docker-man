#!/bin/bash 

base=`dirname $0`
echo $base
sh $base/stop.sh
sh $base/startup.sh
