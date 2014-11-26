#!/usr/bin/env bash

set -o pipefail
set -o errexit
set -o nounset

__DIR__="$(cd "$(dirname "${0}")"; echo $(pwd))"

_usage() {
	echo "usage: ${0} <username>"
	echo "Example: ${0} john.doe"
	exit 1
}

_fail() {
    if [[ "$#" -gt 0 ]]; then
		echo "${1}";
	fi
	echo "Exiting script."
	exit 1
}

# check input
if [[ "$#" -lt 1 ]] || [[ "${1}" == "help" ]] || [[ "${1}" == "--help" ]] || [[ "${1}" == "-h" ]]; then
	_usage
fi

# set the need variables
declare source_code_path="$(dirname "${__DIR__}")"
declare destination_user="${1}"
declare destination_servers="dssysweb01.dominionenterprises.com dssysweb02.dominionenterprises.com"
declare destination_code_path="/var/www/html/releng"

# verify that the project has been built
if [ ! -d "${source_code_path}/vendor" ]; then
	_fail "Please run a build before you make further attempts to deploy!"
fi

# deploy the code
for server in ${destination_servers}; do
    echo "Deploying code to ${server}..."
    rsync -aruvz --delete \
        --exclude="cache/*/*" \
        --exclude=".idea" \
        --exclude="bin" \
        --exclude="*.md" \
        --exclude=".git*" \
        --exclude="*.iml" \
        --exclude="phpunit.xml*" \
        --exclude="composer.*" \
        --exclude="tests" \
        --exclude="reports" \
        --exclude="env.php" \
        "${source_code_path}"/* \
        "${destination_user}@${server}:${destination_code_path}" &&
    echo "Done deploying the code to ${server}."
done

# Finish up
echo "Done deploying the Release Engineering Portal!"
exit 0
