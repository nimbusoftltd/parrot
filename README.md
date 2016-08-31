# Parrot

[![Author](http://img.shields.io/badge/author-@chrisnharvey-blue.svg?style=flat-square)](https://twitter.com/chrisnharvey)
[![Build Status](https://img.shields.io/travis/nimbusoftltd/parrot/master.svg?style=flat-square)](https://travis-ci.org/nimbusoftltd/parrot)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/nimbusoft/parrot.svg?style=flat-square)](https://packagist.org/packages/nimbusoft/parrot)
[![Total Downloads](https://img.shields.io/packagist/dt/nimbusoft/parrot.svg?style=flat-square)](https://packagist.org/packages/nimbusoft/parrot)

Parrot is an extensable backup system written in PHP. It is designed to make it easy
to create backups of files, databases and more and upload these to one or many different
filesystem adapters using (Flysystem)[https://github.com/thephpleague/flysystem].

## Configuration

Parrot is configured using YAML files. Simply create a ```parrot.yml``` file then
run ```parrot``` to start the backup.
