#!/bin/bash
# 2   3       6          7                         11  12
SQLU="SOMEUSER"
SQLP="SOMEPASSWORD"
DB="ncslogger"
IFSORIG=$IFS
IFS="
"
for i in `cat in.log`
do
#echo "[$i]"
	MCALL=$(echo $i | awk -F"," {'print $2'})
	MST=$(echo $i | awk -F"," {'print $3'})
	MCITY=$(echo $i | awk -F"|" {'print $6'})
	MNAME=$(echo $i | awk -F"|" {'print $7'})
	MCOUNTY=$(echo $i | awk -F"|" {'print $11'})
	MGRID=$(echo $i | awk -F"|" {'print $12'})
        MNET="W5RRR"
	MSEL=""
	MTIM="CURRENT_TIME()"
#echo "'$MCALL','$MST','$MCITY','$MNAME','$MCOUNTY','$MGRID','$MNET','$MSEL','$MTIM'); "
#echo "INSERT INTO callsigndb (callsign,state,town,name,county,grid,net,selected,lastheard) VALUES ('$MCALL','$MST','$MCITY','$MNAME','$MCOUNTY','$MGRID','$MNET','$MSEL',CURRENT_TIME() ); "
CLIST=`mysql --user=$SQLU --password=$SQLP $DB << EOF
INSERT INTO callsigndb (callsign,state,town,name,county,grid,net,selected,lastheard) VALUES ('$MCALL','$MST','$MCITY','$MNAME','$MCOUNTY','$MGRID','$MNET','$MSEL',CURRENT_TIME() );
EOF
`

done
echo "DONE"
