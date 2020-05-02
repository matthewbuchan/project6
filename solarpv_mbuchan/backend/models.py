from django.db import models

# Create your models here.
class TestSequence(models.Model):
    sequenceid = models.CharField(max_length=35)
    sequencename = models.CharField(max_length=35)

class Product(models.Model):
    modelnumber = models.CharField(max_length=35)
    productname = models.CharField(max_length=35)
    celltechnology = models.CharField(max_length=35)
    cellmanufacturer = models.CharField(max_length=35)
    numberofcells = models.IntegerField()
    numberofcellsinseries = models.IntegerField()
    numberofseriesinstrings = models.IntegerField()
    numberofdiodes = models.IntegerField()
    productlength = models.FloatField()
    productwidth = models.FloatField()
    productweight = models.FloatField()
    superstatetype = models.CharField(max_length=35)
    superstatemanufacturer = models.CharField(max_length=35)
    substratetype = models.CharField(max_length=35)
    substratemanufacturer = models.CharField(max_length=35)
    frametype = models.CharField(max_length=35)
    frameadhesive = models.CharField(max_length=35)
    encapsulatetype = models.CharField(max_length=35)
    encapsulatemanufacturer = models.CharField(max_length=35)
    junctionboxtype = models.CharField(max_length=35)
    junctionboxmanufacturer = models.CharField(max_length=60)

class Client(models.Model):
    clientname = models.CharField(max_length=35)
    clienttype = models.CharField(max_length=35)

class TestStandard(models.Model):
    standardname = models.CharField(max_length=35)
    description = models.CharField(max_length=35)
    publisheddate = models.CharField(max_length=35)    

class Location(models.Model):
    address1 = models.CharField(max_length=35)
    address2 = models.CharField(max_length=35)
    city = models.CharField(max_length=35)
    state = models.CharField(max_length=35)
    postalcode = models.CharField(max_length=35)
    country = models.CharField(max_length=35)
    phonenumber = models.CharField(max_length=35)
    faxnumber = models.CharField(max_length=35)
    clientid = models.CharField(max_length=35)

class User(models.Model):
    username = models.CharField(max_length=35)
    clientid = models.CharField(max_length=35)
    firstname = models.CharField(max_length=35)
    lastname = models.CharField(max_length=35)
    middlename = models.CharField(max_length=35)
    jobtitle = models.CharField(max_length=35)
    email = models.CharField(max_length=35)
    officephone = models.CharField(max_length=35)
    cellphone = models.CharField(max_length=35)
    appellation = models.CharField(max_length=10)

    def __str__(self):
        return self.username
    

class Certificate(models.Model):
    userid = models.CharField(max_length=35)
    reportnumber = models.CharField(max_length=35)
    issuedate = models.CharField(max_length=35)
    standardid = models.CharField(max_length=35)
    locationid = models.CharField(max_length=35)
    modelnumber = models.CharField(max_length=35)
    
    def __str__(self):
        return self.userid
    

class Service(models.Model):
    servicename = models.CharField(max_length=35)
    description = models.CharField(max_length=35)
    isfirequired = models.CharField(max_length=35)
    fifrequency = models.CharField(max_length=35)
    standardid = models.CharField(max_length=35)

class PerformanceData(models.Model):
    modelnumber = models.CharField(max_length=35)
    sequenceid = models.CharField(max_length=35)
    maxsystemvoltage = models.CharField(max_length=35)
    voc = models.FloatField()
    isc = models.FloatField()
    vmp = models.FloatField()
    imp = models.FloatField()
    pmp = models.FloatField()
    ff = models.FloatField()