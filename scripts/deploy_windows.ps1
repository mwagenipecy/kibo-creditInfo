param(
    [string]$KeyPath = "$env:USERPROFILE\.ssh\KiboAutosever_key.pem",
    [string]$Remote = "azureuser@40.127.10.196",
    [string]$TarName = "kiboauto-deploy.tar.gz"
)

Write-Host "Packing project into $TarName"

$cwd = Get-Location

# Prefer 7z if available (produces tar.gz using 7z + gzip if installed)
if (Get-Command 7z -ErrorAction SilentlyContinue) {
    Write-Host "Using 7z to create tar.gz archive"
    & 7z a -ttar "$env:TEMP\kiboauto-deploy.tar" "$cwd\*" -xr!.git -xr!vendor -xr!node_modules -xr!storage
    & 7z a -tgzip "$env:TEMP\$TarName" "$env:TEMP\kiboauto-deploy.tar"
} else {
    Write-Host "7z not found — using Compress-Archive to create zip and then convert to gz if needed"
    $zipPath = "$env:TEMP\kiboauto-deploy.zip"
    if (Test-Path $zipPath) { Remove-Item $zipPath }
    Compress-Archive -Path "$cwd\*" -DestinationPath $zipPath -Force -CompressionLevel Optimal
    # Convert zip to tar.gz requires external tools; instead upload zip and let remote extract if unzip available
    $TarName = "kiboauto-deploy.zip"
    Copy-Item $zipPath "$env:TEMP\$TarName" -Force
}

$localTar = Join-Path $env:TEMP $TarName
Write-Host "Uploading $localTar to remote /tmp"

if (!(Test-Path $KeyPath)) {
    Write-Error "Key not found at $KeyPath"
    exit 1
}

# Use scp to copy the file (requires OpenSSH client installed on Windows)
scp -i "$KeyPath" $localTar "$Remote:/tmp/$TarName"

Write-Host "SSH to remote to extract and run remote setup"
ssh -i "$KeyPath" "$Remote" bash -lc "\
  if [ -f /tmp/$TarName ]; then \
    mkdir -p /tmp/kiboauto-deploy; \
    if [[ \"$TarName\" == *.zip ]]; then unzip -o /tmp/$TarName -d /tmp/kiboauto-deploy; else tar -xzf /tmp/$TarName -C /tmp/kiboauto-deploy; fi; \
  fi; \
  bash /tmp/kiboauto-deploy/scripts/remote_setup.sh || bash /tmp/kiboauto-deploy/scripts/remote_setup.sh"

Write-Host "Deployment complete (ssh command returned)."
