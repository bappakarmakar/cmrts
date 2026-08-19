#!/bin/sh
	if [ -z "$1" ]
	then
		TARGET_DIR=$PWD
	else
		TARGET_DIR=$1
	fi
# generate target filename
	td=$(date "+%d-%m-%y_%H%M%S")	
	HASH_OUT=$PWD"/hashout_$td.txt"
# recursively search files in the target directory & compute SHA256 hash
	find $TARGET_DIR -type f -exec sha256sum "{}" + >$HASH_OUT
	echo "DONE!!"
# sort '/root/Desktop/identify/checklist_RUSA.txt' '/root/Desktop/identify/checklist_RUSA_2.txt' | uniq -u