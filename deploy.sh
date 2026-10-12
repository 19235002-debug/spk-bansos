#!/usr/bin/env bash

# Menjalankan script deploy utama
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"
bash "$SCRIPT_DIR/deploy" "$@"
