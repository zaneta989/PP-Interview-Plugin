# Matomo PaywallPlugin

## Installation

To enable development environment for PaywallPlan plugin you can use provided `start.sh` script, which clones Matomo
repository and then builds and runs docker.

Then, in your browser navigate to `http://localhost`. Matomo installation wizard should be displayed.

When prompted, use following values:
```
database host: mysql
database user: root
database password: dev
database name: dev
```

Other options aren't important (you can use any values).

After the installation, run following commands:

`docker exec php ./console development:enable`

`docker exec php ./console plugin:activate PaywallPlugin`

`docker exec php ./console core:update --yes`

Those commands enable Matomo's development mode, enable PaywallPlugin and do database updates.
You can also enable this plugin in the settings panel.

## Example page

Example page is available on `http://localhost:8080`.
