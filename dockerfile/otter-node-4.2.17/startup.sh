#!/bin/bash 

sleep `expr $OTTER_ZOOKEEPER_SESSIONTIMEOUT / 1000 + 1`

/usr/local/otter/node/bin/stop.sh

# 删除otter所在进程，防止otter进行没有被正常杀死导致重启报错
ps -ef|grep otter|grep java|awk '{print $2}'|xargs kill -9

# 配置 NID
echo $NODE_ID > /usr/local/otter/node/conf/nid

# 配置文件变量替换函数(参数1: 参数的定义 参数2: 替换参数的值)
function replace_parameter()
{
        a='\/';b='\\\/';value=`echo "$2" | sed "s/$a/$b/g"`
        sed -i "s/$1/$value/g" /usr/local/otter/node/conf/otter.properties 
}

replace_parameter  "@OTTER_ZOOKEEPER_SESSIONTIMEOUT" "$OTTER_ZOOKEEPER_SESSIONTIMEOUT"
replace_parameter  "@OTTER_COMMUNICATION_POOL_SIZE" "$OTTER_COMMUNICATION_POOL_SIZE"
replace_parameter  "@OTTER_MANAGER_ADDRESS" "$OTTER_MANAGER_ADDRESS"
sed -i "s/@LOG_LEVEL/$LOG_LEVEL/g" /usr/local/otter/node/conf/logback.xml
sed -i "s/@LOG_APPENDER/$LOG_APPENDER/g" /usr/local/otter/node/conf/logback.xml

current_path=`pwd`
case "`uname`" in
    Linux)
		bin_abs_path=$(readlink -f $(dirname $0))
		;;
	*)
		bin_abs_path=`cd $(dirname $0); pwd`
		;;
esac
base=${bin_abs_path}/..
otterNodeIdFile=$base/conf/nid
logback_configurationFile=$base/conf/logback.xml
export LANG=en_US.UTF-8

if [ -f $base/bin/otter.pid ] ; then
	echo "found otter.pid , Please run stop.sh first ,then startup.sh" 2>&2
    exit 1
fi

if [ ! -d $base/logs/node ] ; then 
	mkdir -p $base/logs/node
fi

if [ -z "$ARIA2C" ]; then
  ARIA2C=$(which aria2c)
fi

if [ -z "$ARIA2C" ]; then
	source $HOME/.bash_profile
	ARIA2C=$(which aria2c)
	
	if [ -z "$ARIA2C" ]; then
		echo "Cannot find a aria2c. Please set in your PATH in .bash_profile." 2>&2
		#exit 1;
	fi
fi

## set java path
if [ -z "$JAVA" ] ; then
  JAVA=$(which java)
fi

ALIBABA_JAVA="/usr/alibaba/java/bin/java"
TAOBAO_JAVA="/opt/taobao/java/bin/java"
if [ -z "$JAVA" ]; then
  if [ -f $ALIBABA_JAVA ] ; then
  	JAVA=$ALIBABA_JAVA
  elif [ -f $ALIBABA_JAVA ] ; then
  	JAVA=$TAOBAO_JAVA
  else
  	echo "Cannot find a Java JDK. Please set either set JAVA or put java (>=1.5) in your PATH." 2>&2
    exit 1
  fi
fi

case "$#" 
in
0 ) 
	;;
1 )	
	var=$*
	if [ -d $var ] 
	then 
		otterNodeIdFile=$var
        logback_configurationFile=$base/conf/logback.xml
	elif [ -f $var ] ; then 
		otterNodeIdFile=$base/conf/nid
        logback_configurationFile=$var
	else
		echo "THE PARAMETER IS NOT CORRECT.PLEASE CHECK AGAIN."
        exit
	fi;;
2 )	
	var1=$1
	var2=$2
	if [ -d $var1 -a -f $var2 ] ; then
		otterNodeIdFile=$var1
		logback_configurationFile=$var2
	elif [ -d $var2 -a -f $var1 ] ; then  
		otterNodeIdFile=$var2
		logback_configurationFile=$var1
	else 
		if [ "$1" = "debug" ]; then
			DEBUG_PORT=$2
			DEBUG_SUSPEND="n"
			JAVA_DEBUG_OPT="-Xdebug -Xnoagent -Djava.compiler=NONE -Xrunjdwp:transport=dt_socket,address=$DEBUG_PORT,server=y,suspend=$DEBUG_SUSPEND"
		fi
     fi;;
* )
	echo "THE PARAMETERS MUST BE TWO OR LESS.PLEASE CHECK AGAIN."
	exit;;
esac

str=`file $JAVA | grep 64-bit`
if [ -n "$str" ]; then
	JAVA_OPTS="-server -Xms$JAVA_XMS -Xmx$JAVA_XMX -Xmn$JAVA_XMN -XX:SurvivorRatio=2 -XX:PermSize=96m -XX:MaxPermSize=256m -Xss256k -XX:-UseAdaptiveSizePolicy -XX:MaxTenuringThreshold=15 -XX:+DisableExplicitGC -XX:+UseConcMarkSweepGC -XX:+CMSParallelRemarkEnabled -XX:+UseCMSCompactAtFullCollection -XX:+UseFastAccessorMethods -XX:+UseCMSInitiatingOccupancyOnly -XX:+HeapDumpOnOutOfMemoryError"
else
	JAVA_OPTS="-server -Xms$JAVA_XMS -Xmx$JAVA_XMX -XX:NewSize=128m -XX:MaxNewSize=128m -XX:MaxPermSize=128m "
fi

JAVA_OPTS=" $JAVA_OPTS -Djava.awt.headless=true -Djava.net.preferIPv4Stack=true -Dfile.encoding=UTF-8"
OTTER_OPTS="-DappName=otter-node -Ddubbo.application.logger=slf4j -Dlogback.configurationFile=$logback_configurationFile -Dnid=$(cat $otterNodeIdFile)"

if [ -e $otterNodeIdFile -a -e $logback_configurationFile ]
then 
	for i in $base/lib/*;
	do CLASSPATH=$i:"$CLASSPATH";
	done
	CLASSPATH="$base/conf:$CLASSPATH";
 
	echo LOG CONFIGURATION : $logback_configurationFile
	echo Otter nodeId file : $otterNodeIdFile 
	echo CLASSPATH :$CLASSPATH

  echo "cd to $bin_abs_path for workaround relative path"
  cd $bin_abs_path

	$JAVA $JAVA_OPTS $JAVA_DEBUG_OPT $OTTER_OPTS -classpath .:$CLASSPATH com.alibaba.otter.node.deployer.OtterLauncher 
	# echo $! > $base/bin/otter.pid 

  echo "cd to $current_path for continue"
  cd $current_path
else 
	echo "otterNodeIdFile file("$otterNodeIdFile") OR log configration file($logback_configurationFile) is not exist,please create then first!"
fi
