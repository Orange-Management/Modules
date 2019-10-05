# Introduction

The **Helper** module is a very powerful module which allows users to create custom tools/helpers and make them available to other users. A very common use case is to create custom reports which can be based on the Orange-Management database but also on data from other databases. Other examples could be a helper to generate recurring mailings based on data stored in the database or small applications for storing and managing data.

## Target Group

The target group for this module is every organization which would like to create customized helper & reports while still integrating and managing them through the Orange-Management application. The implementation of such helpers requires programming knowledge in PHP and potentially JavaScript.

# Setup

This module doesn't have any additional setup requirements since it is installed during the application install process.

# Features

## Permission Management

It's possible to only give selected users and groups access to certain helper.

## Input handling

The custom helper can be created in a way which allows UI interaction by the user and it's also possible to allow helper to handle uploaded user data. E.g. a tool could create different reports based on the date defined by the user.

In some cases it's not possible to directly access data from within the application for such purposes it's possible to create helper which take additional data as uploads and use/transform this data according to the in the tool defined specifications. This way the same tool can be used in re-curring situation to create different results based on the different data without re-writing or re-uploading the tool every time. E.g. a tool could create reports based on uploaded data in excel or csv format.

## Localization

The module allows users to create helper which also support localization.

## Default UI styles

Users can make use of the default styles in order to create tools which fit visually into the application design for a better user experience.