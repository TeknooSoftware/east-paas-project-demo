Teknoo Software - PaaS project example
======================================

Example of project runnable thanks to [Teknoo East PaaS library project](https://github.com/TeknooSoftware/east-paas).

The installation steps *(composer, webpack, submodule, bash script, npm, etc.)*, the creation of images, 
and the configuration of containers, pods and services are defined into the configuration file **[.paas.yml](.paas.yml)**, must be placed at the root of the project.

You can define some variables in the configuration file **(only in value, not keys)** using the following syntax `${[a-zA-Z][a-zA-Z0-9_-]*}`.
Variables must be passed to the PaaS manager's api when the job is created. They are not stored.

The repository's organisation is completely free and can follow your own guidelines. Files and folders to inject into pods's containers
must be defined into the collection `volumes`. Theses volumes can be attached to pod's containers.

If the PaaS worker does not provide the docker image of your dreams, you can create your own docker image, 
or extends an provided image by the PaaS worker, to use in your pod, thanks to the collection `images`.

Support this project
---------------------

This project is free and will remain free, but it is developed on my personal time. 
If you like it and help me maintain it and evolve it, don't hesitate to support me on [Patreon](https://patreon.com/teknoo_software).
Thanks :) Richard. 

Credits
-------
Richard Déloge - <richarddeloge@gmail.com> - Lead developer.
Teknoo Software - <https://teknoo.software>

About Teknoo Software
---------------------
**Teknoo Software** is a PHP software editor, founded by Richard Déloge.
Teknoo Software's goals : Provide to our partners and to the community a set of high quality services or software,
 sharing knowledge and skills.

License
-------
East PaaS is licensed under the MIT License - see the licenses folder for details
