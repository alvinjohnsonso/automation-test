#!/bin/sh

if [ -z "$1" ]
    then
        echo "Release version wasn't specified";
        exit 1;
fi

build_dir=$(dirname $0);
release_version=$1;

echo "Creating temporary directory"
rm -rf $build_dir/test-$release_version
mkdir $build_dir/test-$release_version

echo "Copying files to directory"
cp -r $build_dir/../src $build_dir/test-$release_version
cp $build_dir/../README.md $build_dir/test-$release_version

echo "Creating zip file"
(cd $build_dir && zip -9 -rq test-$release_version.zip test-$release_version)

echo "Cleaning up"
rm -rf $build_dir/test-$release_version

echo "Done!"
