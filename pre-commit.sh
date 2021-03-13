#!/usr/bin/env bash
# Inspired by Sergey Protko: https://gist.github.com/fesor/1043aec3f1aeac7d801c270e0fba36cd

# Link this to the .git/hooks folder to have it run automatically when commits are made:
#
# $ ln -s ../../pre-commit.sh .git/hooks/pre-commit.sh
#

CHANGED_FILES=$(git diff --cached --name-only --diff-filter=ACM -- '*.php')

if [ -n "$CHANGED_FILES" ]; then

    docker run --rm \
        -u 1000 \
        -v $(pwd):/var/www \
        -w /var/www \
        stagerightlabs/php-test-runner:7.4 vendor/bin/php-cs-fixer fix --config=".php_cs" --quiet $CHANGED_FILES

    git add $CHANGED_FILES;
fi
