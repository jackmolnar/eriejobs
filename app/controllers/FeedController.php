<?php

use EriePaJobs\Jobs\JobsRepository;

class FeedController extends \BaseController {

	/**
	 * @var JobsRepository
	 */
	private $jobRepo;

	function __construct(JobsRepository $jobRepo)
	{
		$this->jobRepo = $jobRepo;
	}

	/**
	 * Display the specified resource.
	 * GET /feed/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$result = $this->jobRepo->allActiveJobs();

		if($id == 'ziprecruiter')
		{
			foreach ($result as $job)
			{
				$job = $this->remapCategoriesZiprecruiter($job);
			}
		}

		return Response::view('feeds.'.$id, ['jobs' => $result])->header('Content-Type', 'application/xml');
	}

	public function remapCategoriesZiprecruiter($job)
	{
		switch ($job->categories->first()->category)
		{
			case "Administrative and Clerical" :
				$job->categories->first()->category = 'Admin/Secretarial';
				break;
			case "Biotech, R&D, and Science" :
				$job->categories->first()->category = 'Biotech/Pharmaceutical';
				break;
			case "Banking" :
				$job->categories->first()->category = 'Banking';
				break;
			case "Business" :
				$job->categories->first()->category = 'Management & Exec';
				break;
			case "Construction" :
				$job->categories->first()->category = 'Construction/Skilled Trade';
				break;
			case "Creative and Design" :
				$job->categories->first()->category = 'Art/Media/Writers';
				break;
			case "Customer Support and Client Care" :
				$job->categories->first()->category = 'Customer Service';
				break;
			case "Editorial and Writing" :
				$job->categories->first()->category = 'Admin/Secretarial';
				break;
			case "Education" :
				$job->categories->first()->category = 'Education';
				break;
			case "Engineering" :
				$job->categories->first()->category = 'Engineering';
				break;
			case "Food Services and Hospitality" :
				$job->categories->first()->category = 'Hospitality/Restaurant';
				break;
			case "Government" :
				$job->categories->first()->category = 'Gov/Military';
				break;
			case "Human Resources" :
				$job->categories->first()->category = 'HR & Recruiting';
				break;
			case "Insurance" :
				$job->categories->first()->category = 'Insurance';
				break;
			case "IT and Software Development" :
				$job->categories->first()->category = 'Information Technology';
				break;
			case "Legal" :
				$job->categories->first()->category = 'Legal';
				break;
			case "Manufacturing" :
				$job->categories->first()->category = 'Manufacturing/Operations';
				break;
			case "Marketing" :
				$job->categories->first()->category = 'Marketing/PR';
				break;
			case "Medical and Health" :
				$job->categories->first()->category = 'Healthcare';
				break;
			case "Nonprofit" :
				$job->categories->first()->category = 'Nonprofit & Fund';
				break;
			case "Other" :
				$job->categories->first()->category = 'Everything Else';
				break;
			case "Project and Program Management" :
				$job->categories->first()->category = 'Management & Exec';
				break;
			case "Quality Assurance and Safety" :
				$job->categories->first()->category = 'Quality Assurance';
				break;
			case "Real Estate" :
				$job->categories->first()->category = 'Real Estate';
				break;
			case "Retail" :
				$job->categories->first()->category = 'Retail';
				break;
			case "Sales" :
				$job->categories->first()->category = 'Sales & Biz Dev';
				break;
			case "Salon, Spa, and Fitness" :
				$job->categories->first()->category = 'Salon/Beauty/Fitness';
				break;
			case "Security and Protective Services" :
				$job->categories->first()->category = 'Everything Else';
				break;
			case "Skilled Trades" :
				$job->categories->first()->category = 'Construction/Skilled Trade';
				break;
			case "Transportation" :
				$job->categories->first()->category = 'Trucking/Transport';
				break;
		}

		return $job;
	}

}