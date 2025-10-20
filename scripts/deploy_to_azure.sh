#!/bin/bash
# Deploy project to Azure VM (runs from your local machine)
# Usage: ./scripts/deploy_to_azure.sh /path/to/KiboAutosever_key.pem azureuser@40.127.10.196

KEY_PATH="$1"
REMOTE="$2"

if [[ -z "$KEY_PATH" || -z "$REMOTE" ]]; then
  echo "Usage: $0 /path/to/key.pem user@host"
  exit 1
fi

echo "Syncing repo to remote... (rsync)"
rsync -avz --exclude='.git' --exclude='node_modules' --exclude='vendor' --exclude='storage' ./ $REMOTE:/tmp/kiboauto-deploy

echo "Running remote setup script..."
ssh -i "$KEY_PATH" "$REMOTE" 'bash -s' < ./scripts/remote_setup.sh

echo "Deployment initiated. Check remote logs on the server for progress."
