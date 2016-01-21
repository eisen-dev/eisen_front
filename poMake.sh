#!/usr/bin/env bash

echo -e "\n--- Making .po file ---\n"
find . -iname "*.php" | xargs xgettext --from-code=UTF-8 --default-domain=messages

echo -e "\n--- Moving .po file to the locale directories ---\n"
for d in /vagrant/webd/locale/*/LC_MESSAGES/; do cp messages.po "$d"; done

echo -e "\n--- Remember to restart apache2 after editing the .po files ---\n"
