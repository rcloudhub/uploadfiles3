import boto3

session = boto3.Session( aws_access_key_id='AKIA2UC3A23OPRRF74DU', aws_secret_access_key='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')



s3 = session.resource('s3')

my_bucket = s3.Bucket('rcloudhubn')

for my_bucket_object in my_bucket.objects.all():
    print(my_bucket_object.key)