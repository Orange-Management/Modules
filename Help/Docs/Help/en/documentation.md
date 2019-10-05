# Documentation

A documentation can be added to every module by adding the `Docs/Help/{lang}` directory in the module. The language directory needs to be a 2 character ISO code. Inside of this directory you can add/find all the documentation files provided by the module.

Mandatory files are a `SUMMARY.md` file which contains the list of all documents and a `introduction.md` file which contains a general description of the module.

## SUMMARY.md example

```md
# Table of Contents

* [Link Name 1]({%}&page=document_name_1)
* [Link Name 2]({%}&page=document_name_2)
* [Link Name 3]({%}&page=document_name_3)
```

![Directory Structure](Modules/Help/Docs/Help/img/directory_structure.png)