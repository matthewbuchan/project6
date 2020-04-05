from django.db import models

# Create your models here.
class TestSequence(models.Model):
    sequenceid = models.CharField(max_length=20)
    sequencename = models.CharField(max_length=20)

class Product(models.Model):
    modelnumber = models.CharField(max_length=20)
    productname = models.CharField(max_length=20)
    celltechnology = models.CharField(max_length=20)
    cellmanufacturer = models.CharField(max_length=20)
    numberofcells = models.IntegerField()
    numberofcellsinseries = models.IntegerField()
    numberofseriesinstrings = models.IntegerField()
    numberofdiodes = models.IntegerField()
    productlength = models.FloatField()
    productwidth = models.FloatField()
    productweight = models.FloatField()
    superstatetype = models.CharField(max_length=20)
    superstatemanufacturer = models.CharField(max_length=20)
    substratetype = models.CharField(max_length=20)
    substratemanufacturer = models.CharField(max_length=20)
    frametype = models.CharField(max_length=20)
    frameadhesive = models.CharField(max_length=20)
    encapsulatetype = models.CharField(max_length=20)
    encapsulatemanufacturer = models.CharField(max_length=20)
    junctionboxtype = models.CharField(max_length=20)
    junctionboxmanufacturer = models.CharField(max_length=20)

class Client(models.Model):
    clientname = models.CharField(max_length=20)
    clienttype = models.CharField(max_length=20)

class TestStandard(models.Model):
    standardname = models.CharField(max_length=20)
    description = models.CharField(max_length=20)
    publisheddate = models.CharField(max_length=20)    

class Location(models.Model):
    address1 = models.CharField(max_length=20)
    address2 = models.CharField(max_length=20)
    city = models.CharField(max_length=20)
    state = models.CharField(max_length=20)
    postalcode = models.CharField(max_length=20)
    country = models.CharField(max_length=20)
    phonenumber = models.CharField(max_length=20)
    faxnumber = models.CharField(max_length=20)
    clientid = models.ForeignKey(Client, on_delete=models.CASCADE)

class User(models.Model):
    firstname = models.CharField(max_length=20)
    lastname = models.CharField(max_length=20)
    middlename = models.CharField(max_length=20)
    jobtitle = models.CharField(max_length=20)
    email = models.CharField(max_length=20)
    officephone = models.CharField(max_length=20)
    cellphone = models.CharField(max_length=20)
    prefix = models.CharField(max_length=20)
    clientid = models.ForeignKey(Client, on_delete=models.CASCADE)

class Certificate(models.Model):
    userid = models.ForeignKey(User, on_delete=models.CASCADE)
    reportnumber = models.CharField(max_length=20)
    issuedate = models.CharField(max_length=20)
    standardid = models.ForeignKey(TestStandard, on_delete=models.CASCADE)
    locationid = models.ForeignKey(Location, on_delete=models.CASCADE)
    modelnumber = models.ForeignKey(Product, on_delete=models.CASCADE)
    

class Service(models.Model):
    servicename = models.CharField(max_length=20)
    description = models.CharField(max_length=20)
    isfirequired = models.CharField(max_length=20)
    fifrequency = models.CharField(max_length=20)
    standardid = models.ForeignKey(TestStandard, on_delete=models.CASCADE)

class PerformanceData(models.Model):
    modelnumber = models.ForeignKey(Product, on_delete=models.CASCADE)
    sequenceid = models.ForeignKey(TestSequence, on_delete=models.CASCADE)
    maxsystemvoltage = models.CharField(max_length=20)
    voc = models.FloatField()
    isc = models.FloatField()
    vmp = models.FloatField()
    imp = models.FloatField()
    pmp = models.FloatField()
    ff = models.FloatField()