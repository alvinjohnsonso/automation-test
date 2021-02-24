# Automation Test
This repository is made specifically for testing github actions workflows.

## Release Workflow
The main goal here is to automate releases. This automatically
1. Builds the packages or artifacts made by the software.
2. Creates a new tag and release with the release details coming from [CHANGELOG.md](./CHANGELOG.md).
3. Uploads the zip files to the newly created release.

### Trigger
The current setup only triggers `on merge of a PR` to the `master` branch.

Can learn more about triggers in [Events that trigger workflows](https://docs.github.com/en/actions/reference/events-that-trigger-workflows).

### Steps
1. checkout (uses [actions/checkout@v2](https://github.com/actions/checkout)) - This checkouts the repository's main branch.
2. install tools - This install the tools required by the software which in this case is
    - `jq` - Used for getting values from `json` files.
    - `zip` - Used for creating zip files.
3. version - This allows the next workflow steps to get the current release version. Used `jq` to extract the `version` from the [composer.json](./composer.json).
4. build artifact - This executes the [build-packages.sh](./build/build-packages.sh) file which generates the zip files.
5. release (uses [actions/create-release@v1](https://github.com/actions/create-release)) - This creates the tag and release. The following details are gotten from
    - Tag Name - from step #3 - version
    - Release Name - from step #3 - version
    - Release Details - [CHANGELOG.md](./CHANGELOG.md)
6. upload artifact (uses [actions/upload-release-asset@v1](https://github.com/actions/upload-release-asset)) - This uploads the zip files to the newly created release.
