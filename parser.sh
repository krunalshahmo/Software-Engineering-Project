#!/bin/bash
java URLConnectionReader http://www.cnn.com | grep "<h" > test
