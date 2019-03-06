#! /bin/sh

cd /usr/src/app
./gradlew build --stacktrace
cp /usr/src/app/app/build/outputs/apk/release/app-release-unsigned.apk /shared_folder/area.apk
chmod 444 /shared_folder/area.apk