
import boto3
from botocore.exceptions import NoCredentialsError

# Set your AWS credentials and region
AWS_ACCESS_KEY_ID = 'AKIA2UC3A23OPRRF74DU'
AWS_SECRET_ACCESS_KEY = 'w1ZHb79E55O1jTfwGSaILQYyevhogg3EYeStVE8y'
AWS_REGION = 'eu-north-1'

# Define your bucket name
#BUCKET_NAME = '[rcloudhubn].s3-website-us-west-2.amazonaws.com'
BUCKET_NAME = 'rcloudhubn'
# Function to upload a file to S3
def upload_file_to_s3(file_path, key_name):
    try:
        s3 = boto3.client('s3', aws_access_key_id=AWS_ACCESS_KEY_ID,
                          aws_secret_access_key=AWS_SECRET_ACCESS_KEY,
                          region_name=AWS_REGION)
        s3.upload_file(file_path, BUCKET_NAME, key_name)
        print("File uploaded successfully.")
    except NoCredentialsError:
        print("AWS credentials not available or invalid.")

# Function to list files in S3 bucket
def list_files_in_s3():
    try:
        s3 = boto3.client('s3', aws_access_key_id=AWS_ACCESS_KEY_ID,
                          aws_secret_access_key=AWS_SECRET_ACCESS_KEY,
                          region_name=AWS_REGION)
        response = s3.list_objects_v2(Bucket=BUCKET_NAME)
        files = response.get('Contents', [])
        if files:
            print("Files in bucket:")
            for file in files:
                file_name = file['Key']
                file_url = f"https://{BUCKET_NAME}.s3.amazonaws.com/{file_name}"
                print(f"{file_name}: {file_url}")
        else:
            print("No files found in the bucket.")
    except NoCredentialsError:
        print("AWS credentials not available or invalid.")

# Upload a file
file_to_upload = 'index.py'
file_to_upload = (r'C:\xampp\htdocs\uploadimages\patna.jpeg')
upload_key_name = 'file.txt'  # Name for the file in S3
upload_file_to_s3(file_to_upload, upload_key_name)

# List files in the bucket
list_files_in_s3()

print(upload_key_name+file_to_upload)
