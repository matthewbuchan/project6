# Generated by Django 3.0.4 on 2020-04-04 23:57

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('solarpv', '0003_auto_20200404_2330'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='certificate',
            name='cid',
        ),
    ]