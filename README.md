<div id="top"></div>

[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>

## About The Project

This project allows to easily manage dependencies between projects.

<p align="right">(<a href="#top">back to top</a>)</p>

### Built With

* [PHP](https://www.php.net/)
* [Docker](https://www.docker.com/)
* [Make](https://www.gnu.org/software/make/)

<p align="right">(<a href="#top">back to top</a>)</p>

## Getting Started

### Prerequisites

On your machine you must have :
- Make
- Docker
  
### Installation

Create a .dependencies file that must be in JSON format.<br />
Here is an example of a file with a dependency.

```json
{
  "my-project-name": {
    "path": "my-project-path",
    "repository": "git@github.com:my-project.git"
  }
}
```

`path` must be relative to the parent directory.<br />
`repository` git repository url.

Then edit your project make to add the following lines :

```make
DEPENDENCIES=
CMD_start = docker run -ti --rm -v $(PWD)/../:/mnt/projects/ -e PROJECTNAME=my-project-name -e COMMAND=start -e DEPENDENCIES=${DEPENDENCIES} d3tdistribution/projet-dependencies

start: env
	$(shell ${CMD_start})
```

`PROJECTNAME` is the name of the project.<br />
`COMMAND` is the command to execute for the dependent projets.<br />
`DEPENDENCIES` is the list of dependent projects already started in order to avoid project circular dependencies.

<!-- ROADMAP -->
## Roadmap

- [x] Clone dependencies repositories
- [x] Change dependencies.json to .dependencies file
- [x] Support .dependencies.local file
- [ ] Support absolute path

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#top">back to top</a>)</p>


[contributors-shield]: https://img.shields.io/github/contributors/D3T-Distribution/project-dependencies.svg?style=for-the-badge
[contributors-url]: https://github.com/D3T-Distribution/project-dependencies/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/D3T-Distribution/project-dependencies.svg?style=for-the-badge
[forks-url]: https://github.com/D3T-Distribution/project-dependencies/network/members
[stars-shield]: https://img.shields.io/github/stars/D3T-Distribution/project-dependencies.svg?style=for-the-badge
[stars-url]: https://github.com/D3T-Distribution/project-dependencies/stargazers
[issues-shield]: https://img.shields.io/github/issues/D3T-Distribution/project-dependencies.svg?style=for-the-badge
[issues-url]: https://github.com/D3T-Distribution/project-dependencies/issues
[license-shield]: https://img.shields.io/github/license/D3T-Distribution/project-dependencies.svg?style=for-the-badge
[license-url]: https://github.com/D3T-Distribution/project-dependencies/blob/master/LICENSE.txt