# expens-o-matic
A webapplication writting in Symfony for submitting expenses.

## Current Status

Expens-o-matic is in heavy development phase and is currently not usable for anything remotely useful.
You should wait for a first official release.

## Development

### Database

When starting from an empty database, after configuring the database connection string and ensuring the database user has been created and had
the proper right, you can initialize the database with the following command:

```bash
➜ expens-o-matic git:(master) ✗ php bin/console doctrine:database:create
Created database `expens-o-matic` for connection named default
```

After creating a new Entity or modifying anything database table related, a Migration needs to be created, validated, and then applied.

```bash
➜ expens-o-matic git:(master) ✗ php bin/console make:migration

           
  Success! 
           

 Next: Review the new migration "src/Migrations/Version20191007184110.php"
 Then: Run the migration with php bin/console doctrine:migrations:migrate
 See https://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html
```

Once the changes have been validated, they can be applied to the database with the following command:

```bash
➜ expens-o-matic git:(master) ✗ php bin/console doctrine:migrations:migrate
                                                              
                    Application Migrations                    
                                                              

WARNING! You are about to execute a database migration that could result in schema changes and data loss. Are you sure you wish to continue? (y/n)y
Migrating up to 20191007184657 from 0

  ++ migrating 20191007184657
...
  ++ migrated (took 594.8ms, used 12M memory)

  ------------------------

  ++ finished in 596.6ms
  ++ used 12M memory
  ++ 1 migrations executed
  ++ 9 sql queries
```


## Todo

- [ ] Submitting Expenses
  - [ ] Adding multiple files while not being reviewed
  - [ ] Removing uploaded files while not being reviewed
  - [ ] Client-Side size reduction of to-be-uploaded images
- [ ] Deleting Expenses
- [ ] Updating Expenses while not being reviewed
- [ ] Global view of my expenses, grouped by year/month
- [ ] Interface for approver role
  - [ ] Be able to approve expenses
  - [ ] Be able to approve multiple expenses
  - [ ] Reopen Expenses for modification
  - [ ] Flag expenses as paidout
- [ ] Accounting system
  - [ ] Classic account/password login
  - [ ] LDAP/OAuth
  - [ ] Profile page / Change Password / Gravatar
- [ ] Admin Interface
  - [ ] Adding/Removing/Locking Accounts
  - [ ] Manage Role Assignments
  - [ ] Timezone selection
