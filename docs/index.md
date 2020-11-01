<a href="https://photon-platform.net/">
    <img src="https://photon-platform.net/user/images/photon-logo-banner.png" alt="photon" title="photon" align="right" height="120" />
</a>


# photon * Highlight

## 0.1.0

---


> This plugin provides code highlighting functionality via the [Highlight.js](https://highlightjs.org/) jQuery plugin.

- [configuration](#configuration)
- [templates](#templates)
- [scaffolds](#scaffolds)
- [scss](#scss)
- [assets](#assets)
- [languages](#languages)

# configuration
blueprints.yaml

fields:
- enabled
- lines
- theme

Before configuring this plugin, you should copy the `user/plugins/photon-highlight/photon-highlight.yaml` to `user/config/plugins/photon-highlight.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```
enabled: true
theme: default
lines: false
```

Note that if you use the admin plugin, a file with your configuration, and named photon-highlight.yaml will be saved in the `user/config/plugins/` folder once the configuration is saved in the admin.


# assets

```sh
assets
└── readme_1.png
```


## Installation

- all photon plugins are installed as git submodules. More on that later.



## Configuration


## Usage

Select template type when creating a new page

## Credits


## To Do

- [ ] Future plans, if any


copyright &copy; 2020
