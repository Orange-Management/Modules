# Settings

## Genral

In the admin module under `General` the global settings can be set.

### Security

In the security section it's possible to define and modify the global security settings. These settings will be used for every user.

![General Settings](Modules/Admin/Docs/Help/img/general/settings_security.png)

#### Password Regex

In this field the password strucutre can be defined that is required by every account. Examples are:

##### Password Example 1

At least 8 characters including at least one numeric value, one lower letter, one upper letter, one special char

```^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&;:\(\)\[\]=\{\}\+\-])[.]{8,}```

##### Password Example 2

At least 8 characters including at least one numeric value, one upper letter, one special char

```^(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&;:\(\)\[\]=\{\}\+\-])[.]{8,}```

##### Password Example 3

At least 8 characters including at least one numeric value, one special char

```^(?=.*\d)(?=.*[$@$!%*?&;:\(\)\[\]=\{\}\+\-])[.]{8,}```

##### Password Example 4

At least 8 characters including at least one special char

```^(?=.*[$@$!%*?&;:\(\)\[\]=\{\}\+\-])[.]{8,}```

##### Password Example 5

At least 8 characters

```^[.]{8,}```

##### Password Example 6

At least 12 characters

```^[.]{12,}```

#### Login Retries

In this field the amount of retries can be defined until the user login receives a timeout. During this timeout period no login is possible even if the correct password is entered. Infinite amount of retries can be activated by setting the value to `-1`

**Recommended:** `3 times`

#### Timeout Period

In this field the timeout period after inputting a incorrect password too often can be specified. During this period the user cannot login even if the password is correct. 

**Recommended:** `30 minutes`

#### Password Change Interval

In this field the interval in days can be set in which the password must be changed. If passwords don't have to be changed set the value to `-1`

**Recommended:** `90 days`

#### Password History

In this field the relevant password history can be defined. If a password change interval is defined the new password has to be different from the last `x` passwords

**Recommended:** `3 last passwords`

### Logging

In the logging section the logging settings can be defined. These settings don't include audit logs as they cannot be changed in order to prevent data manipulation.

**Recommended:** `active and default path`

![General Settings](Modules/Admin/Docs/Help/img/general/settings_logging.png)

## Localization

In the localization tab it's possible to define the default localization settings. Be aware that users may have localization settings different from the default settings. These localization settings are only important to provide a fallback if the user localization settings are not working.

![Localization Settings](Modules/Admin/Docs/Help/img/general/settings_localization.png)

### Defaults

In the defaults field you can select a default localization configuration which you can adjust afterwards.
