#!/usr/bin/python
# Koen Hendriks
# 15-10-2014
# Calculate the median read length of a set of reads in a fasta file

import sys
import numpy


input_handle = open(sys.argv[1],"r")

readLengthArray = []
readLengthSet = set()

def readFASTA():
	for read in input_handle.readlines():
		read = read.replace("\n","")
		if not ">" in read:
			pass
		else:
			#print read
			readLength = read.split("=")[1]
			readLengthArray.append(int(readLength))


	#print "##### Sorting!"
	readLengthArray.sort()
	#readLengthSet = set(readLengthArray)
	#print len(readLengthArray)
	#print readLengthSet

def median(x):
    #numpyReadLengthArray = numpy.asarray(readLengthArray)
    #numpy.median(numpyReadLengthArray)

    if len(x)%2 != 0:
    	medianindex = int(len(x)/2 - 0.5)
    	median = x[medianindex]
    	print median

    else:
    	medianindex1 = x[int(len(x)/2)]
    	medianindex2 = x[medianindex1 -1]
    	median = (medianindex1 + medianindex2) /2
    	print median


def main():
	readFASTA()
	median(readLengthArray)
	#createList()

main()



