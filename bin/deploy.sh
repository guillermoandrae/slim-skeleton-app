#!/usr/bin/env bash

set -o pipefail
set -o errexit
set -o nounset

__DIR__="$(cd "$(dirname "${0}")"; echo $(pwd))"

# prints usage statement
_usage() {
	echo "usage: ${0}"
	echo "Deploys your application code to the desired location."
	exit 1
}

# exists the script with an error message; outputs to STDERR
_fail() {
    if [[ "$#" -gt 0 ]]; then
		echo "${1}" 1>&2
	fi
	echo "Exiting script." 1>&2
	exit 1
}

# check input
if [[ "$#" -lt 1 ]] || [[ "${1}" == "help" ]] || [[ "${1}" == "--help" ]] || [[ "${1}" == "-h" ]]; then
	_usage
fi

# set the need variables
declare application_name="Slimish"
declare source_code_path="$(dirname "${__DIR__}")"
declare destination_user="${1}"
declare destination_servers="server1.com server2.com"
declare destination_code_path="/remote/path/to/code"

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
        --exclude="*bower*" \
        --exclude="tests" \
        --exclude="reports" \
        --exclude="env.php" \
        "${source_code_path}"/* \
        "${destination_user}@${server}:${destination_code_path}" &&
    echo "Done deploying the code to ${server}."
done

# Finish up
echo "Done deploying the ${application_name} application!"
exit 0
