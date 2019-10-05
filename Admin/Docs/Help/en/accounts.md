# Accounts

In `Accounts` you can create, delete and modify the accounts. Accounts are necessary for almost all data associated to persons or organizations. Usually modules either create new accounts when they want to store personal data or use an existing account for which the data should be stored.

## General

![General Settings](Modules/Admin/Docs/Help/img/accounts/accounts_general.png)

### ID

The id (unique identifier) is automatically generated.

### Type

An account can be either a:

* `Person`
* or a `Organization`

Both types can have the same permissions and functionality. This can be helpful for a lot of modules that rely on organizations or companies (e.g. a sales module that handles people as customers but also companies as customers).

### Status

An account has the following status:

* Active
* Inactive (usually used for long inactive accounts)
* Timeout (usually used for timeouts in case of bad behavior which will be automatically revoked after a certain time)
* Banned (usually used to disable accounts for an indefinite time)

### Username

Name of the account which can be shown in various places instead of the full name.

### Name1 - Name3

The name of the account. In some cases 3 names are necessary such as first name, middle name and family name. If more than 3 names are required you have to additionally put them into one of the 3 name fields.

### Email

The email field is the main email contact address for the account. This email address will be also used for password recovery.

### Password

The password field can be used to overwrite the current account password. If the password gets changed the user will also receive a notification email.

Alternatively click the `Reset` button and the account will receive an email with a temporary link redirecting the user to a page where he can change the password.

The required password structure is defined in the general settings.

## Permissions

![General Settings](Modules/Admin/Docs/Help/img/accounts/accounts_permissions.png)

Permissions have the following components which can be combined to either address a wide e.g. range of units, applications or modules or in order to address a very specific combination of those.

### Unit

The unit this permission is set for. Leave empty to address all units

### App

The application this permission is set for. Leave empty to address all applications

### Module

The module this permission is set for. Leave empty to address all modules

### Type

The type is a `module` specific subpart which only should be set if the module is defined in the permission. For further information what kind of types are available for a module please refer to the module specific documentation. Usually it refers to a single page of a module.

### Element

The element is a `module` and `type` specific subpart which only should be set if the `type` is defined in the permission. For further information what kind of elements are available for a module and type please refer to the module specific documentation. Usually it refers to a section on a module page.

### Component

The component is a `module`, `type` and `element` specific subpart which only should be set if the `element` is defined in the permission. For further information what kind of components are available for a module, type and element please refers to the module specific documentation. Usually it refers to a single input or option in a module.

### Permission

The actual permission consists of create (C), read (R), update (U), delete (D), permission (P) options.

#### Create (C)

This allows a user to create something. Usually a user should also have (R) permission in this case.

#### Read (R)

This allows a user to read/see something.

#### Update (U)

This allows a user to update/modify something. Usually a user should also have (R) permission in this case.

#### Delete (D)

This allows a user to delete/remove something. Usually a user should also have (R) permission in this case.

#### Permission (P)

This allows a user to change permissions. Usually a user should also have (C, R, U, D) permissions because the user could just give himself these permissions anyways. Only selected users should have this permission even if it is only specified for a specific module, type, element or component.

## Groups

![General Settings](Modules/Admin/Docs/Help/img/accounts/accounts_groups.png)

In the groups section you can see all groups that this account is assigned to  and you can also add or remove the account to other groups. If you would like to add the account to the same groups as a different account just select the account whose groups you would like to copy and the account will be added to the same groups (one time only, there will be **no relation** between the two accounts.

## Audit Log

In the audit log you can see all the changes of the group.